
function createStore (e, b) {
    var store = {
    _data: {},
    dispatch: function(){},
    _callbacks:[],
    construct: function(val, update){
        this._data = val;
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
        return this._data;
    },
    cleanCallbacks: function(){
        this._callbacks = [];
    }}
    store.construct(e ,b);
    return store;

}


var update = function(action){
/* Грязная функция изменения состояния */
    switch (action.type) {
        case "platformNumber":
            this._data.platfNumber = action.payload;
            break;
        case "platfID":
            this._data.platformID = action.payload;  /**Хотелось бы возвращать новый объект, но как на старом js тока в цикле перебирать все */
            break;
        case "repairType":
            this._data.repairType = action.payload;
            break;
        case "repairText":
            this._data.repairText = action.payload;
            break;
        case "repairID":
            this._data.repairID = action.payload;
            break;
        case "repairStart":
            this._data.repairStart = action.payload;
            break;
        case "repairEnd":
            this._data.repairEnd = action.payload;
            break;
        case "addTask":
            this._data.jobs.push(action.payload);
            break;
        case "addjob":
            this._data.jobs.push(action.payload);
            break;
        case "addjobs":
            for(var i=0; i< action.payload.length; i++ ){
                this._data.jobs.push(action.payload[i]);
            }
            break;
        case "addlub":
            this._data.lubjobs.push(val);
            break;
        case "addlubs":
            for(var i=0; i< action.payload.length; i++ ){
                this._data.lubjobs.push(action.payload[i]);
            }
            break;
        case "repIdPlatfNum":
            this._data.repairID = action.payload.repairID;
            this._data.platfNumber = action.payload.platfNumber;
            break;
        case "repTextStartEnd":
            this._data.repairText = action.payload.repairText;
            this._data.repairStart = action.payload.repairStart;
            this._data.repairEnd = action.payload.repairEnd;
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

function sine1(){
    console.log(
        "Номер платформы - " + store.get().platfNumber + "\n" +
        " список к смазке " + store.get().lubjobs
    )}

repair.sine(
    function(){ console.log(repair.get()); }
);
// store.dispatch( "platformNumber", 222 );
// store.dispatch("addlubs", [ "Смазать там", "Смазать сям"]);
// store.dispatch("addlub", "Смазать тута");