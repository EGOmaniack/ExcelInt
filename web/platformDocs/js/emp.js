


function empUpdate(action){
    switch (action.type) {
        case "":
            
            break;
    
        default:
            break;
    }
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