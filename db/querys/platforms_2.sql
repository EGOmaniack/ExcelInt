select * from repair_stuff.gostost;
select * from repair_stuff.work_sections;
select * from repair_stuff.repair_jobs;
select * from repair_stuff."Consumables";

insert into repir_stuff.work_sections
( name, weight )
values ( 'Раздел 2', 333 )
;

insert into repair_stuff.repair_jobs ( razdel, subparagraph, name, work_type )
select ws.id, '1.1', 'Имя работы', wt.id
from repair_stuff.work_sections ws, repair_stuff.work_type wt
where ws."name" = 'Подготовительные работы'
and wt.code = 'other'
;

insert into repair_stuff."Consumables" ( id_work, name, mark, consumption_rate )
select rj.id, 'Имя детали', 'Ст3', '12'
from repair_stuff.repair_jobs rj
where rj."name"='Отчистка деталей и сборочных едениц от грязи, старой отслоившейся краски и ржавчины'
;