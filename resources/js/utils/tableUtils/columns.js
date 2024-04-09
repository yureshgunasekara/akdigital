export const groupHeader = [
   {
      Header: "Document Name",
      accessor: "document_name",
      id: "document",
   },
   {
      Header: "Template Used",
      accessor: "template.title",
   },
   {
      Header: "Created On",
      accessor: "created_at",
      id: "created",
   },
   {
      Header: "Language",
      accessor: "language",
   },
   {
      Header: "Words Used",
      accessor: "word_count",
   },
   {
      Header: "Action",
      accessor: "",
      id: "action",
   },
];

export const supportRequests = [
   {
      Header: "Ticket Id",
      accessor: "ticket_id",
      id: "ticket",
   },
   {
      Header: "Status",
      accessor: "status",
      id: "status",
   },
   {
      Header: "Category",
      accessor: "category",
      id: "category",
   },
   {
      Header: "Subject",
      accessor: "subject",
      id: "subject",
   },
   {
      Header: "Priority",
      accessor: "priority",
      id: "priority",
   },
   {
      Header: "Created Date",
      accessor: "created_at",
      id: "created",
   },
   {
      Header: "Action",
      accessor: "",
      id: "action",
   },
];

export const subscriptionPlans = [
   {
      Header: "Plan Title",
      accessor: "title",
      id: "title",
   },
   {
      Header: "Plan Type",
      accessor: "type",
      id: "type",
   },
   {
      Header: "Status",
      accessor: "status",
      id: "status",
   },
   {
      Header: "Monthly Price",
      accessor: "monthly_price",
      id: "monthly_price",
   },
   {
      Header: "Yearly Price",
      accessor: "yearly_price",
      id: "yearly_price",
   },
   {
      Header: "Created On",
      accessor: "created_at",
      id: "created",
   },
   {
      Header: "Action",
      accessor: "",
      id: "action",
   },
];

export const templatesManagement = [
   {
      Header: "Template Name",
      accessor: "title",
      id: "title",
   },
   {
      Header: "Template Type",
      accessor: "type",
      id: "type",
   },
   {
      Header: "Status",
      accessor: "status",
      id: "status",
   },
   {
      Header: "Template Description",
      accessor: "description",
      id: "description",
   },
   {
      Header: "Action",
      accessor: "",
      id: "action",
   },
];

export const usersManagement = [
   {
      Header: "User",
      accessor: "",
      id: "user",
   },
   {
      Header: "User Type",
      accessor: "type",
      id: "type",
   },
   {
      Header: "Account Status",
      accessor: "status",
      id: "status",
   },
   {
      Header: "Registered On",
      accessor: "created_at",
      id: "created",
   },
   {
      Header: "Action",
      accessor: "",
      id: "action",
   },
];

export const registeredUsers = [
   {
      Header: "User",
      accessor: "",
      id: "user",
   },
   {
      Header: "User Type",
      accessor: "type",
      id: "type",
   },
   {
      Header: "Account Status",
      accessor: "status",
      id: "status",
   },
   {
      Header: "Registered On",
      accessor: "created_at",
      id: "created",
   },
];

export const transactionsGroup = [
   {
      Header: "User Name",
      accessor: "user",
      id: "user",
   },
   {
      Header: "Plan Name",
      accessor: "name",
      id: "plan",
   },
   {
      Header: "Price",
      accessor: "price",
      id: "price",
   },
   {
      Header: "Order Id",
      accessor: "order_id",
      id: "order_id",
   },
   {
      Header: "Gateway",
      accessor: "gateway",
      id: "gateway",
   },
   {
      Header: "Paid On",
      accessor: "paid_on",
      id: "paid_on",
   },
];

export const subscribersGroup = [
   {
      Header: "User Name",
      accessor: "user.name",
      id: "user",
   },
   {
      Header: "Plan Name",
      accessor: "name",
      id: "plan",
   },
   {
      Header: "Status",
      accessor: "status",
      id: "status",
   },
   {
      Header: "Subscription Id",
      accessor: "subscription_id",
      id: "subscription_id",
   },
   {
      Header: "Pricing Plan",
      accessor: "pricing_plan",
      id: "pricing_plan",
   },
   {
      Header: "Subscribed On",
      accessor: "subscribed_on",
      id: "subscribed_on",
   },
   {
      Header: "Next Payment On",
      accessor: "next_payment",
      id: "next_payment",
   },
];

export const codesGroup = [
   {
      Header: "Title",
      accessor: "title",
      id: "title",
   },
   {
      Header: "Language",
      accessor: "language",
      id: "language",
   },
   {
      Header: "Description",
      accessor: "description",
      id: "description",
   },
   {
      Header: "Created",
      accessor: "created_at",
      id: "created",
   },
   {
      Header: "Words Used",
      accessor: "word_count",
      id: "word_count",
   },
   {
      Header: "Action",
      accessor: "",
      id: "action",
   },
];

export const speechToTextGroup = [
   {
      Header: "Title",
      accessor: "title",
      id: "title",
   },
   {
      Header: "Created Text",
      accessor: "text",
      id: "text",
   },
   {
      Header: "Created",
      accessor: "created_at",
      id: "created",
   },
   {
      Header: "Words Used",
      accessor: "word_count",
      id: "word_count",
   },
   {
      Header: "Action",
      accessor: "",
      id: "action",
   },
];

export const textToSpeechGroup = [
   {
      Header: "Title",
      accessor: "title",
      id: "title",
   },
   {
      Header: "Audio Language",
      accessor: "language",
      id: "language",
   },
   {
      Header: "Voice",
      accessor: "voice",
      id: "voice",
   },
   {
      Header: "Created",
      accessor: "created_at",
      id: "created",
   },
   {
      Header: "Audio",
      accessor: "audio",
      id: "audio",
   },
   {
      Header: "Action",
      accessor: "",
      id: "action",
   },
];
