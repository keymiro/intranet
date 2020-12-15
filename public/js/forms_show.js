function mostrarform(id)
{
    switch (id)
    {
        case "system_form":
            $("#system_form").show();
            $("#maintenance_form").hide();
            $("#quality_form").hide();
            $("#siau_form").hide();
            $("#rrhh_form").hide();
            $("#form_change_turn").hide();
            $("#form_work_vacation").hide();
            break;
        case "maintenance_form":
            $("#system_form").hide();
            $("#maintenance_form").show();
            $("#quality_form").hide();
            $("#siau_form").hide();
            $("#rrhh_form").hide();
            $("#form_change_turn").hide();
            $("#form_work_vacation").hide();
            break;
        case "quality_form":
            $("#system_form").hide();
            $("#maintenance_form").hide();
            $("#quality_form").show();
            $("#siau_form").hide();
            $("#rrhh_form").hide();
            $("#form_change_turn").hide();
            $("#form_work_vacation").hide();
            break;
        case "siau_form":
            $("#system_form").hide();
            $("#maintenance_form").hide();
            $("#quality_form").hide();
            $("#siau_form").show();
            $("#rrhh_form").hide();
            $("#form_change_turn").hide();
            $("#form_work_vacation").hide();
            break;
        case "rrhh_form":
            $("#system_form").hide();
            $("#maintenance_form").hide();
            $("#quality_form").hide();
            $("#siau_form").hide();
            $("#rrhh_form").show();
            $("#form_change_turn").hide();
            $("#form_work_vacation").hide();
            break;

        case "form_change_turn":
            $("#system_form").hide();
            $("#maintenance_form").hide();
            $("#quality_form").hide();
            $("#siau_form").hide();
            $("#rrhh_form").hide();
            $("#form_change_turn").show();
            $("#form_work_vacation").hide();
            break;

        case "form_work_vacation":
            $("#system_form").hide();
            $("#maintenance_form").hide();
            $("#quality_form").hide();
            $("#siau_form").hide();
            $("#rrhh_form").hide();
            $("#form_change_turn").hide();
            $("#form_work_vacation").show();
            break;

    }

}
