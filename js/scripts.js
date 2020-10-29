/**
 * scripts.js
 *
 * Computer Science 50
 * Problem Set 7
 *
 * Global JavaScript, if any.
 */


 var sellButton = document.querySelector(".btn1");
 var autoSellectButtons = document.querySelectorAll(".dropselect");
 var hiddButt = document.querySelector(".hidsym");

 function btnSelect(e) {
     e.preventDefault();
    
     console.log("click");
     if (sellButton) {
    sellButton.innerHTML = this.innerHTML+"<span class='caret'></span>";
     }
    hiddButt.value = this.innerHTML;

 }

 for (let autoSellectButton of autoSellectButtons) {
     
    autoSellectButton.addEventListener("click",btnSelect);
 }