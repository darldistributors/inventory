    var selectedProductsID = getSelected("{{trim($_GET['items'] ?? '')}}")
    var total = 0;
    var allProducts = {};
    
    boot();

    function boot(){
      //initial
      var cartedItems = document.getElementsByClassName("cart_items");
      var grandTotal = 0;

      for (let i = 0; i < cartedItems.length; i++) {
        var id = cartedItems[i].id
        getAllProductsDetails(
          id,
          Number(document.getElementById('quantity'+id).value), 
          Number(document.getElementById('selling_price'+id).innerHTML)
        );
      }
      
      // document.getElementById('grand_total').innerHTML = grandTotal;
      // return grandTotal
    }

    function getSelected(text){
      var allItems = {}
      var it = text.split(',')
      for (var i = 0; i < it.length; i++) {
        allItems[it[i]] = true;
      }

      return allItems;
    }

    function selectedProduct(selectedID){
      var currentPage = window.location.href
      var splitted = currentPage.split('?items=')
      
      if(selectedProductsID[selectedID] === true) return addStatus(); //stop exec

      if(splitted[1] === undefined) {
        window.location = '?items=' + selectedID, splitted
        return
      }

      window.location = '?items=' + splitted[1] + ',' + selectedID
      return
    }

    function addStatus(){
      document.getElementById('err').style.display = 'block'

      setTimeout(function() {
        document.getElementById('err').style.display = 'none'
      }, 1500);
    }

    function updateTotal(selectedID, sellingPrice, availableGoods){
      //update total
      var selectedQty = document.getElementById('quantity'+selectedID);
      var itemTotal = document.getElementById('item_total'+selectedID);
      // var grandTotal = document.getElementById('grand_total');

      var selectedQty_ = Number(selectedQty.value);
      var itemTotal_ = Number(itemTotal.innerHTML);
      // var grandTotal_ = Number(grandTotal.innerHTML);
      availableGoods = Number(availableGoods)
      sellingPrice = Number(sellingPrice);
      
      if(isNaN(selectedQty_) || selectedQty_ < 1 || selectedQty_ > availableGoods  || isNaN(itemTotal_) || isNaN(sellingPrice)){
        alert('An error just occured. One or more values are not actual numbers')
        return
      }

      itemTotal_ = (sellingPrice * selectedQty_)
      itemTotal.innerHTML = itemTotal_
      
      getAllProductsDetails(selectedID, selectedQty_, sellingPrice)
      // console.log(allProducts)
    }

    function getAllProductsDetails(id, selectedQty_, sellingPrice){
      allProducts[id] = {
          productName: document.getElementById('name'+id).innerHTML,
          quantity: selectedQty_,
          selling_price: sellingPrice,
          total: selectedQty_ * sellingPrice
      }
      document.getElementById('all_products').innerHTML = JSON.stringify(allProducts)
      calculateGrandTotal()
    }

    function calculateGrandTotal(){
      // get all item total and calculate grand total
      var itemTotals = document.getElementsByClassName("item_total");
      var discount = Number(document.getElementById("discount").value);
      var debt = Number(document.getElementById("debt").value);
      var grandTotal = 0;

      for (let i = 0; i < itemTotals.length; i++) {
        grandTotal += Number(itemTotals[i].innerHTML);
      }
      
      var subTotal = grandTotal - (discount + debt)
      
      document.getElementById('grand_total').innerHTML = subTotal;
      document.getElementById('grand_total2').value = grandTotal;
      return grandTotal

    }

    function removeSelectedItem(rowID){
      // remove from cart
      if(selectedProductsID[rowID] === undefined){
        alert('Selected item does not exist')
      }

      delete selectedProductsID[rowID]
      if(Object.keys(selectedProductsID).length === 0) {
        window.location = window.location.href.split('?items=')[0]
        return
      }
      // console.log(selectedProductsID)
     window.location = '?items='+Object.keys(selectedProductsID).join(',')
      return

      if(selectedProductsID[selectedID] === true) return addStatus(); //stop exec

    if(splitted[1] === undefined) {
      window.location = '?items=' + selectedID, splitted
      return
    }

    window.location = '?items=' + splitted[1] + ',' + selectedID
    return
    }