function mostrar(id) {
    if (id == "system") {
        $("#system").show();
        $("#maintenance").hide();
        $("#quality").hide();
        $("#siau").hide();
        $("#rrhh").hide();
    }

    if (id == "maintenance") {
        $("#system").hide();
        $("#maintenance").show();
        $("#quality").hide();
        $("#siau").hide();
        $("#rrhh").hide();
    }

    if (id == "quality") {
        $("#system").hide();
        $("#maintenance").hide();
        $("#quality").show();
        $("#siau").hide();
        $("#rrhh").hide();
    }

    if (id == "siau") {
        $("#system").hide();
        $("#maintenance").hide();
        $("#quality").hide();
        $("#siau").show();
        $("#rrhh").hide();
    }
    if (id == "rrhh") {
        $("#system").hide();
        $("#maintenance").hide();
        $("#quality").hide();
        $("#siau").hide();
        $("#rrhh").show();
    }

}
