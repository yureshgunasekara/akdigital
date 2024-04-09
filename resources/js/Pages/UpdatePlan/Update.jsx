import Card from "@/Components/Card";
import { Head, router, useForm } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Pricing from "@/Components/Icons/Pricing";
import { useEffect, useState } from "react";
import Dashboard from "@/Layouts/Dashboard";
import { Button } from "@material-tailwind/react";

const Update = (props) => {
   const { plan, type, methods } = props;
   const [activeMethod, setActiveMethod] = useState(payment_methods[0]);

   useEffect(() => {
      methods.map((method) => {
         for (let i = 0; i < payment_methods.length; i++) {
            let element = payment_methods[i];
            if (element.id === method.name) {
               element.allow = Boolean(method.active);
               break;
            }
         }
      });
      const active = payment_methods.find((item) => item.allow === true);
      setActiveMethod(active);
   }, []);

   const { data, setData, reset, post } = useForm({
      plan_id: plan.id,
      billing_type: type,
   });

   useEffect(() => {
      const selectPlan = methods.find((item) => item.name === activeMethod.id);
      setData("plan_id", selectPlan.id);
   }, [activeMethod]);

   const submit = (e) => {
      e.preventDefault();
      if (activeMethod.method === "GET") {
         router.get(
            `${activeMethod.route}?plan_id=${plan.id}&billing_type=${type}`
         );
      } else {
         router.post(activeMethod.route, {
            plan_id: plan.id,
            billing_type: type,
         });
      }
   };

   return (
      <>
         <Head title="Update Plan" />
         <Breadcrumb Icon={Pricing} title="Update Plan" />

         <div className="max-w-[1200px] w-full mx-auto">
            <div className="grid grid-cols-12 gap-7">
               <div className="col-span-12 lg:col-span-8">
                  <p className="text20 font-medium">Payment Gateways</p>
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-7 mt-7">
                     {payment_methods.map((method, index) => {
                        return (
                           <div
                              key={method.id}
                              onClick={() => setActiveMethod(method)}
                              className={`shadow-card rounded-lg p-7 flex items-center justify-between hover:outline hover:outline-2 hover:outline-primary-500 cursor-pointer h-[100px] ${
                                 activeMethod.id === method.id &&
                                 "outline outline-2 outline-primary-500"
                              }`}
                           >
                              <p>{method.name}</p>
                              <img
                                 src={method.logo}
                                 alt=""
                                 className={
                                    method.id === "stripe" ||
                                    method.id === "mollie"
                                       ? "w-[100px]"
                                       : "w-[44px]"
                                 }
                              />
                           </div>
                        );
                     })}
                  </div>
               </div>

               <div className="col-span-12 lg:col-span-4">
                  <p className="text20 font-medium">Order Summery</p>
                  <Card className="p-6 mt-7">
                     <div className="flex items-center justify-between mb-5">
                        <p className="font-medium text-gray-600">Plan Name</p>
                        <p className="font-medium text-gray-900">
                           {plan.title}
                        </p>
                     </div>
                     <div className="flex items-center justify-between mb-5">
                        <p className="font-medium text-gray-600">Plan Type</p>
                        <p className="font-medium text-gray-900">{plan.type}</p>
                     </div>
                     <div className="flex items-center justify-between mb-5">
                        <p className="font-medium text-gray-600">
                           Billing Type
                        </p>
                        <p className="capitalize font-medium text-gray-900">
                           {type}
                        </p>
                     </div>
                     <div className="flex items-center justify-between">
                        <p className="font-medium text-gray-600">
                           Billing Price
                        </p>
                        <p className="font-medium text-gray-900">
                           {type === "monthly"
                              ? plan.monthly_price
                              : plan.yearly_price}{" "}
                           {plan.currency}
                        </p>
                     </div>

                     <form onSubmit={submit}>
                        <Button
                           type="submit"
                           color="white"
                           className="w-full capitalize bg-primary-500 text-white text-sm !rounded-lg px-5 mt-7"
                        >
                           Submit
                        </Button>
                     </form>
                  </Card>
               </div>
            </div>
         </div>
      </>
   );
};

let payment_methods = [
   {
      id: "stripe",
      name: "Stripe",
      method: "POST",
      route: "/stripe/payment",
      allow: false,
      logo: "/assets/logo/Stripe2.png",
   },
   {
      id: "paypal",
      name: "Paypal",
      method: "POST",
      route: "/paypal/payment",
      allow: false,
      logo: "/assets/logo/Paypal.png",
   },
   {
      id: "razorpay",
      name: "Razorpay",
      method: "GET",
      route: "/razorpay/form",
      allow: false,
      logo: "/assets/logo/Razorpay2.png",
   },
   {
      id: "mollie",
      name: "Mollie",
      method: "POST",
      route: "/mollie/payment",
      allow: false,
      logo: "/assets/logo/Mollie.png",
   },
   {
      id: "paystack",
      name: "Paystack",
      method: "GET",
      route: "/paystack/redirect",
      allow: false,
      logo: "/assets/logo/Paystack.png",
   },
];

Update.layout = (page) => <Dashboard children={page} />;

export default Update;
