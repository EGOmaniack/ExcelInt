


function empUpdate(action){
    switch (action.type) {
        case "":
            
            break;
    
        default:
            break;
    }
}




var repair = createStore({
    platforms:[], /* перечень платформ вида { id: "Из БД", number:"номер платформы", fullName:"полное название из БД" } */
    repairs:[]  /* перечень всех ремонтов id, type,  */
},
update);

repair.SetDev();/**Включаем режим разработки
                * Все изменения state будут записываться в _history
                */