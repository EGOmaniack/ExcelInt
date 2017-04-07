
var store = {
    _data: {},
    update: function(){},
    _callbacks:[],
    construct: function(val, update){
        this._data = val;
        this.update = update;
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
    }
}

var update = function(type, val){
/* Грязная функция изменения состояния */
    switch (type) {
        case "platformNumber":
            this._data.platfNumber = val;
            break;
        case "platfID":
            this._data.platformID = val;  /**Хотелось бы возвращать новый объект, но как на старом js тока в цикле перебирать все */
            break;
        case "repairType":
            this._data.repairType = val;
            break;
        case "repairText":
            this._data.repairText = val;
            break;
        case "repairID":
            this._data.repairID = val;
            break;
        case "repairStart":
            this._data.repairStart = val;
            break;
        case "repairEnd":
            this._data.repairEnd = val;
            break;
        case "addTask":
            this._data.jobs.push(val);
            break;
        case "addjob":
            this._data.jobs.push(val);
            break;
        case "addjobs":
            for(var i=0; i< val.length; i++ ){
                this._data.jobs.push(val[i]);
            }
            break;
        case "addlub":
            this._data.lubjobs.push(val);
            break;
        case "addlubs":
            for(var i=0; i< val.length; i++ ){
                this._data.lubjobs.push(val[i]);
            }
            break;
        case "repIdPlatfNum":
            this._data.repairID = val.repairID;
            this._data.platfNumber = val.platfNumber;
            break;
        case "repTextStartEnd":
            this._data.repairText = val.repairText;
            this._data.repairStart = val.repairStart;
            this._data.repairEnd = val.repairEnd;
            break;
        default:
            console.log("Неизвестная команда");
            break;
    }
    this.callback();
}

store.construct({
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

store.sine(
    function(){ console.log(store.get()); }
);
// store.update( "platformNumber", 222 );
// store.update("addlubs", [ "Смазать там", "Смазать сям"]);
// store.update("addlub", "Смазать тута");