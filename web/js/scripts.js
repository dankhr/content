$(document).ready(function() {

    $('select[id^="pc-id"]').change(function () {
       var sum = 0;
        $('select[id^="pc-id"] option:selected').each(function () {
           if ($(this).val()) {
                var curr_pc = $(this).text();
                var start_pos = curr_pc.lastIndexOf('(');
                var cur_price = curr_pc.substr(start_pos+1, curr_pc.length-start_pos-8);
                sum += +cur_price;
           }
       });
       $('#pc-price').val(sum);
    });

});