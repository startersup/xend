$(".add").click(function() {
    $('.xd-mid-pos').hide();
});
$('.add').on('click', add);
​$(document).on('click','.product-remove', function() {
    $(this).parent().remove();
});

function add() {
    var new_input = "<div class='xd-add-wrapper'><input type='text' class='form-control xd-form-md-inputs req-products' placeholder='eg: Maida Maavu - 1kg' > <button class='remove xd-remove-pos product-remove' > x </button></div>";
    $('#new_chq').append(new_input);
}

/*
var items = document.querySelectorAll(".products");
for (var index = 0; index < items.length; index++) {
    items[index].addEventListener("click", function() {
        this.classList.toggle("active");
    });
    items[index].querySelector("a").addEventListener("click",
        function() {
            this.closest(".products").remove();
        });
}

*/