
function createStore (state, updateFunc) {
var store = { /**Нужна функция ресет на начальный state */
    developMode: false,/**Режим разработки (запись в историю) */
    _state: {}, /** */
    dispatch: function(){},
    _callbacks:[],
    __history:[],
    construct: function(val, update){
        this._state = val;
        this.dispatch = update;
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
        return this._state;
    },
    cleanCallbacks: function(){
        this._callbacks = [];
    },
    SetDev: function(){
        console.log("Developer mode on");
        this.developMode = true;
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
            this._state.jobs.push(action.payload);
            break;
        case "addjobs":
            for(var i=0; i< action.payload.length; i++ ){
                this._state.jobs.push(action.payload[i]);
            }
            break;
        case "addlub":
            this._state.lubjobs.push(action.payload);
            break;
        case "addlubs":
            for(var i=0; i< action.payload.length; i++ ){
                this._state.lubjobs.push(action.payload[i]);
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
        default:
            console.log("Неизвестная команда");
            break;
    }
    this.callback();
}

var repair = createStore({
    platfNumber: null,
    platformID: null,
    repairType: null,
    repairText: null,
    repairID: null,
    repairStart: null,
    repairEnd: null,
    jobs : [],
    lubjobs:[]
},
update);

repair.SetDev();/**Включаем режим разработки
                * Все изменения state будут записываться в _history
                */

// repair.sine(
//     function(){ console.log(repair.get()); }
// );
// store.dispatch( "platformNumber", 222 );
// store.dispatch("addlubs", [ "Смазать там", "Смазать сям"]);
// store.dispatch("addlub", "Смазать тута");