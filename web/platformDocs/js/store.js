
function createStore (state, updateFunc) {
var store = { /**Нужна функция ресет на начальный state */
    developMode: false,/**Режим разработки (запись в историю) */
    _state: {}, /** */
    dispatch: function(){},
    _callbacks:[],
    __history:[],
    construct: function(state, update){
        this._state = state;
        this.dispatch = update;
        this._initialState = this._copyState(state);
    },
    sine: function(func){
        this._callbacks.push(func)
    },
    callback: function(){
        if(this._callbacks != undefined ){
            this._callbacks.forEach(function(elem) {
                elem.call();    
            }, this);
        }
    },
    get: function(){
        return $().extend( true,{} ,this._state );
    },
    cleanCallbacks: function(){
        this._callbacks = [];
    },
    SetDev: function(){
        console.log("Developer mode on");
        this.developMode = true;
    },
    _copyState: function (state){   /**функция копирует состояние */
                    return $().extend( true,{} ,state );
    },
    _initialState: {},
    __resetState: function(){
        this._state = this._copyState(this._initialState);
        this.cleanCallbacks();
    }
}
    store.construct(state , updateFunc);
    return store;
}

var update = function(action){
    if(this.developMode) this.__history.push(this.get())
 /* Грязная функция изменения состояния */
    switch (action.type) {
        case "platformNumber":
            this._state.platfNumber = action.payload;
            break;
        case "platfID":
            this._state.platformID = action.payload;  /**Хотелось бы возвращать новый объект, но как на старом js тока в цикле перебирать все */
            break;
        case "repairType":
            this._state.repairType = action.payload;
            break;
        case "repairText":
            this._state.repairText = action.payload;
            break;
        case "repairID":
            this._state.repairID = action.payload;
            break;
        case "repairStart":
            this._state.repairStart = action.payload;
            break;
        case "repairEnd":
            this._state.repairEnd = action.payload;
            break;
        case "addTask":
            this._state.jobs.push(action.payload);
            break;
        case "addjob":
            this._state.jobs.push({ id: action.payload.id, name: action.payload.name});
            break;
        case "addjobs":
            var newjobs = action.payload;/* Надо выяснять разницу для БД */
            if(newjobs.length > 0){
                this._state.jobs = [];
                newjobs.forEach(function(item){
                    this._state.jobs.push(item);
                }, this);
            }
            break;
        case "addNewJobs":
            var newjobs = action.payload;
            if(newjobs.length > 0){
                $.post("./ajax/addjobs.php", {
                    repair_id: this.get().repairID,
                    jobs: newjobs
                    },function (data) {
                    if(data != undefined){
                        location.href = '/platformDocs/index.php';
                    }
                });
            }
            break;
        case "addlub":
            this._state.lubjobs.push({ id: action.payload.id, name: action.payload.name});
            break;
        case "setlubs":
            for(var i=0; i< action.payload.length; i++ ){
                this._state.lubjobs.push(
                    { id: action.payload[i].id, name: action.payload[i].name});
            }
            break;
        case "repIdPlatfNum":
            this._state.repairID = action.payload.repairID;
            this._state.platfNumber = action.payload.platfNumber;
            break;
        case "repTextStartEnd":
            this._state.repairText = action.payload.repairText;
            this._state.repairStart = action.payload.repairStart;
            this._state.repairEnd = action.payload.repairEnd;
            break;
        case "reset":
            this.__resetState();
            break;
        default:
            console.log("Неизвестная команда");
            break;
    }
    this.callback();
}


// repair.sine(
//     function(){ console.log(repair.get()); }
// );
// store.dispatch( "platformNumber", 222 );
// store.dispatch("addlubs", [ "Смазать там", "Смазать сям"]);
// store.dispatch("addlub", "Смазать тута");