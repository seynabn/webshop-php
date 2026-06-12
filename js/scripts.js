//  JavaScript
//  Den här delen gör att sidan inte behöver laddas om varje gång vi gör något på sidan.

// vad gör funktionen addToCart()?
// addToCart(productId) -javascript.
// funktionen anropas när användaren klickar på knappen addtocart.

// Skickar request:
// fetch(`/javascriptAddToCart?id=${productId}`)
// ↓
// PHP
// ↓
// Databas
// ↓
// JSON tillbaka.

// Exempel JSON:
// {
//   "cartItemCount": 4,
//   "cartTotalPrice": 799
// }

// Sedan: document.getElementById("cartItemCount")
// uppdateras direkt.

// vad gör drawCart()?
// Ritar om hela varukorgen.

// För varje produkt: cartItems.forEach(...)
// skapas en ny tabellrad.
// <tr>
// med: namn, pris, antal, summa

function drawCart(cartItems, cartTotalPrice, cartTotalWeight, freightCost) {
  const cartTotalPriceElement = document.getElementById("cartTotalPrice");
  if (cartTotalPriceElement) {
    document.getElementById("cartTotalPrice").innerText = cartTotalPrice;
  }
  const cartTotalWeightElement = document.getElementById("cartTotalWeight");
  if (cartTotalWeightElement) {
    document.getElementById("cartTotalWeight").innerText = cartTotalWeight;
  }
  const freightCostElement = document.getElementById("freightCost");
if (freightCostElement) {
    freightCostElement.innerText = freightCost + " SEK";
}
const grandTotalElement =
        document.getElementById("grandTotal");

    if (grandTotalElement) {
        grandTotalElement.innerText =
            cartTotalPrice + " SEK";
    }
  

  const cartItemElement = document.getElementById("cartItems");
  console.log(cartItemElement);

  if (cartItemElement) {
    cartItemElement.innerHTML = "";

    cartItems.forEach((cartItem) => {
      cartItemElement.innerHTML += `
                <tr>
                    <td>${cartItem.productName}</td>
                    <td>${cartItem.productPrice}</td>
                    <td>${cartItem.quantity}</td>
                    <td>${cartItem.productPrice * cartItem.quantity}.00</td>
                    <td>
                        <button onclick="addToCart(${cartItem.productId})" class="btn btn-primary">+</button>
                        <button onclick="removeFromCart(${cartItem.productId})" class="btn btn-danger">-</button>
                    </td>
                </tr>
            `;
    });
  }

  const totalEl = document.getElementById("cartTotalPrice");
  if (totalEl) {
    totalEl.innerText = cartTotalPrice + " SEK";
  }
}
// fetch cart

function getSelectedFreightRuleId() {
  const selectElement = document.getElementById("freightRulesSelect");
  if (selectElement) {
    return selectElement.value;
  }
  return null;
}

async function fetchCartItems() {
  let resp = await fetch("/javascriptFetchCart");
  let data = await resp.json();
  console.log(data);
  return data;
}
// remove from cart btn
async function removeFromCart(productId) {
  let resp = await fetch(`/javascriptRemoveFromCart?id=${productId}`);
  let data = await resp.json();
  document.getElementById("cartItemCount").innerText = data.cartItemCount;
const freightRuleId = getSelectedFreightRuleId();

    if (freightRuleId) {
        let shippingResp = await fetch(`/calculateShipping?id=${freightRuleId}`);
        let shippingData = await shippingResp.json();

        drawCart(
            shippingData.cartItems,
            shippingData.cartTotalPrice,
            shippingData.cartTotalWeight,
            shippingData.freightCost
        );
    } else {
        drawCart(data.cartItems, data.cartTotalPrice, data.cartTotalWeight,data.freightCost);
    }
}



// add to cart btn
async function addToCart(productId) {
  let resp = await fetch(`/javascriptAddToCart?id=${productId}`);
  let data = await resp.json();
  document.getElementById("cartItemCount").innerText = data.cartItemCount;

const freightRuleId = getSelectedFreightRuleId();

    if (freightRuleId) {
        let shippingResp = await fetch(`/calculateShipping?id=${freightRuleId}`);
        let shippingData = await shippingResp.json();

        drawCart(
            shippingData.cartItems,
            shippingData.cartTotalPrice,
            shippingData.cartTotalWeight,
            shippingData.freightCost
        );
    } else {
        drawCart(data.cartItems, data.cartTotalPrice, data.cartTotalWeight,data.freightCost);
    }

}