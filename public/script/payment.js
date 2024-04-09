// Selecting the payment method
const methods = document.querySelectorAll(".payment_method");
if (methods) {
   methods.forEach((element, index) => {
      // checkoutForm
      if (index === 0) {
         element.classList.add("outline-2", "outline-primary-500");
         const info = JSON.parse(element.dataset.info);
         document.getElementById("paymentMethod").innerText = info.name;

         const checkoutForm = document.getElementById("checkoutForm");
         checkoutForm.setAttribute("method", info.method);
         checkoutForm.setAttribute("action", info.route);
      }

      element.addEventListener("click", () => {
         methods.forEach((item) =>
            item.classList.remove("outline-2", "outline-primary-500")
         );
         const info = JSON.parse(element.dataset.info);
         document.getElementById("paymentMethod").innerText = info.name;
         element.classList.add("outline-2", "outline-primary-500");

         const checkoutForm = document.getElementById("checkoutForm");
         checkoutForm.setAttribute("method", info.method);
         checkoutForm.setAttribute("action", info.route);
      });
   });
}
