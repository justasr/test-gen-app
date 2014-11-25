

$(function() {

    $("#qa_1_add").click( function() {
        //        Default Value
        if( $(".qa_1_con").find('tbody .test_check_box:checked').length == 0 )
            $(".qa_1_con").find('tbody .test_check_box:first').prop( "checked", true );

        value = $(".qa_1_con").find('tbody tr').size();
        $(".qa_1_con").find('tbody')
            .append('<tr><td> <input class="test_check_box" name="qa_1_corrent[]" type="radio" value="'+value+'"> </td><td> <input type="text" class="form-control" name="qa_1[]" value=""> </td></tr>');
    });

    $("#qa_1_delete").click( function() {
        if( $(".qa_1_con").find('tbody tr').length > 1 )
            $(".qa_1_con").find('tbody tr:last').remove();


        // Default Value
        if( $(".qa_1_con").find('tbody .test_check_box:checked').length == 0 )
            $(".qa_1_con").find('tbody .test_check_box:first').prop( "checked", true );
    });

    $("#qa_2_add").click( function() {
        value = $(".qa_2_con").find('tbody tr').size();
        $(".qa_2_con").find('tbody')
            .append('<tr><td> <input class="test_check_box" name="qa_2_corrent[]" type="checkbox" value="'+value+'"> </td><td> <input type="text" class="form-control" name="qa_2[]" value=""> </td></tr>');

        // Default Value
        if( $(".qa_2_con").find('tbody .test_check_box:checked').length == 0 )
            $(".qa_2_con").find('tbody .test_check_box:first').prop( "checked", true );
    });

    $("#qa_2_delete").click( function() {
        if( $(".qa_2_con").find('tbody tr').length > 1 )
            $(".qa_2_con").find('tbody tr:last').remove();


        // Default Value
        if( $(".qa_2_con").find('tbody .test_check_box:checked').length == 0 )
            $(".qa_2_con").find('tbody .test_check_box:first').prop( "checked", true );
    });

    $("#qa_3_add").click( function() {
        value = $(".qa_3_con").find('tbody tr').size();
        $(".qa_3_con").find('tbody')
            .append('<tr><td> <input style="display:none" checked class="test_check_box" name="qa_3_corrent[]" type="checkbox" value="'+value+'"> </td><td> <input type="text" class="form-control" name="qa_3[]" value=""> </td></tr>');
    });

    $("#qa_3_delete").click( function() {
        if( $(".qa_3_con").find('tbody tr').length > 1 )
            $(".qa_3_con").find('tbody tr:last').remove();
    });

    $("#question_type").change( function() {
        type_id = $(this).val();
        $(".answer-con").hide();

        if( type_id == -1 )
            return;

        $("#qa_"+type_id+"_main").show();
    });

    $("#question_type").change();

});