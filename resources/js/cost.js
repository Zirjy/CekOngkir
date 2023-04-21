$(document).ready(function(){
    $('select[name="province_origin"]').on('change', function(){
        let provinceid = $(this).val();
        if (provinceid) {
            jQuery.ajax({
                url: 'api/province/'+provinceid+'/citys',
                Type:"GET",
                dataType:"json",
                success:function(data){
                    $('select[name="city_origin"').empty();
                    $.each(data, function(key, value) {
                        $('select[name="city_origin"').append(` <option value="${key }">${value}</option>`)
                    })
                }
            })
        } else {
            $('select[name="city_origin"]').empty()

        }
    });
});

$('#destination').select2({
    ajax: {
        url: '/api/citys',
        type: 'POST',
        dataType: 'json',
        delay: 150,
        data: function (params){
            return{
                _token: $('meta[name="csrf-token"]').attr('content'),
                search: $.trim(params.term)
            }
        },
        processResults: function (response){
            return{
                result: response
            }
        },
        cache: true
    }
})