ToDo

Bottone elimina immagine in edit

Filtro project per type

# Relazione many to many

Una technology ha tanti project, un project ha tante technology

-   creo il pacchetto per Technology `php artisan make:model -rmsR` name Technology

-   facendo coi però devo spostare il controller in admin e cambiare l' import nel model

-   inserisco i campi title e slug nella migration e la runno

-   creo il seeder con le technology

-   creo migrazione per tabella pivot, nomi tabelle in ordine alfabetico (`php artisan make:migration create_project_technology_table`)

-   istruisco i model in base alla relazione

-   gestisco inserimento e creazione delle technoly in create project

-   semplice parte di crud e gestione dei valori e dei casi, avendo un array derivante da una select dovrò agire diversamente (ciclo sull' array per avere ogni technology associata)
