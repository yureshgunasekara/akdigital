import { Head } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Setting from "@/Components/Icons/Setting";
import StripeSettings from "@/Components/Forms/StripeSettings";
import PaypalSettings from "@/Components/Forms/PaypalSettings";
import RazorpaySettings from "@/Components/Forms/RazorpaySettings";
import MollieSettings from "@/Components/Forms/MollieSettings";
import PaystackSettings from "@/Components/Forms/PaystackSettings";
import Dashboard from "@/Layouts/Dashboard";

const PaymentSettings = (props) => {
   const { stripe, razorpay, paypal, mollie, paystack } = props;

   return (
      <>
         <Head title="Payment Settings" />
         <Breadcrumb Icon={Setting} title="Payment Settings" />

         <StripeSettings stripe={stripe} />
         <RazorpaySettings razorpay={razorpay} />
         <PaypalSettings paypal={paypal} />
         <MollieSettings mollie={mollie} />
         <PaystackSettings paystack={paystack} />
      </>
   );
};

PaymentSettings.layout = (page) => <Dashboard children={page} />;

export default PaymentSettings;
