/**
 * Created by vmcb on 01-11-2016.
 */
$().ready(function () {
    $("#prod_type").change(function () {
        $("#prod").empty();
        $("#prod").append('' +
            '<label>Produto</label><br>'+
            '<select name="product" id="product">'+
                '<option></option>'+
            '</select>');
        if ($(this).val() == 1) {
            getProducts('current');
        }else if($(this).val() == 2){
            getProducts('saving');
        }else{
            getProducts('loan');
        }
    });
    function getProducts(type) {
        $.getJSON('/product/'+type,'',function (data) {
            for (i = 0; i < data.length; i++) {
                $.ajax({
                    url:'/product/'+data[i].product_id,
                    specProd: data[i],
                    success: function (data2) {
                        $("#product").append('<option value="' + this.specProd.id + '">' + data2.name + '</option>');
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        });
    }

    $("#prod").on("change","#product",function () {
        $("#amount").removeAttr("disabled");
    });

    $("#addAccount").submit(function (e) {
        $(this).append(
          "<input type='hidden' name='cliData' value='"+sessionStorage.getItem("clientData")+"'>"
        );
        return true;
    })
});