/*==================== SHOW NAVBAR ====================*/
const showMenu = (headerToggle, navbarId) => {
    const toggleBtn = document.getElementById(headerToggle),
        nav = document.getElementById(navbarId)

    // Validate that variables exist
    if (headerToggle && navbarId) {
        toggleBtn.addEventListener('click', () => {
            // We add the show-menu class to the div tag with the nav__menu class
            nav.classList.toggle('show-menu')
                // change icon
            toggleBtn.classList.toggle('bx-x')
        })
    }
}
showMenu('header-toggle', 'navbar')

/*==================== LINK ACTIVE ====================*/
const linkColor = document.querySelectorAll('.nav__link')

function colorLink() {
    linkColor.forEach(l => l.classList.remove('active'))
    this.classList.add('active')
}

linkColor.forEach(l => l.addEventListener('click', colorLink))

// function loadProduct(id) {
//     $.ajax({
//         url: "/glass/public/product/getProduct",
//         type: "POST",
//         data: {
//             "product-id": id
//         },
//         success: function(result) {
//             console.log(result);
//             var jsonResult = JSON.parse(result);

//             var data = jsonResult['data']['data'];

//             $.each(data, function(key, value) {
//                 var productId = value['product_id'];
//                 var productName = value['product_name'];
//                 var productDesc = value['product_desc'];
//                 var productRate = value['product_rate'];

//                 $("#product-id").val(productId);
//                 $("#product-name").val(productName);
//                 $("#product-rate").val(productRate);
//                 $("#product-Desc").val(productDesc);

//                 $("#search-result").html("");

//             });
//         },
//         error: function(result) {
//             console.log(result);
//         }
//     });
// }