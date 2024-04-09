import Enable from "./Icons/Enable";
import Disable from "./Icons/Disable";
import { useForm } from "@inertiajs/react";
import { useEffect, useState } from "react";
import { Button, Dialog, IconButton } from "@material-tailwind/react";

const PlanStatusChange = (props) => {
    const { id, status } = props;
    const [planDisableModal, setPlanDisableModal] = useState(false);

    const { patch, setData, reset, wasSuccessful } = useForm({
        status: "",
    });

    const statusChange = (id) => {
        patch(route("plans.update", id));
    };

    const statusOpenModal = () => {
        if (planDisableModal) {
            reset("status");
            setPlanDisableModal(false);
        } else {
            setPlanDisableModal(true);
        }
    };

    const statusHandler = (status) => {
        setPlanDisableModal(true);
        if (status === "active") {
            setData("status", "deactive");
        } else {
            setData("status", "active");
        }
    };

    useEffect(() => {
        if (wasSuccessful) {
            setPlanDisableModal(false);
        }
    }, [wasSuccessful]);

    return (
        <div className="flex justify-end items-center">
            <IconButton
                variant="text"
                color="white"
                onClick={() => statusHandler(status)}
                className="w-7 h-7 rounded-full hover:bg-primary-50 text-gray-500 hover:text-primary-500"
            >
                {status === "active" ? (
                    <Disable className="h-4 w-4" />
                ) : (
                    <Enable className="h-4 w-4" />
                )}
            </IconButton>

            <Dialog
                size="xs"
                open={planDisableModal}
                handler={statusOpenModal}
                className="px-7 py-10"
            >
                {status === "active" ? (
                    <p className="text22 font-medium text-red-500 text-center mb-10">
                        Are you sure to deactive plan?
                    </p>
                ) : (
                    <p className="text22 font-medium text-primary-500 text-center mb-10">
                        Are you sure to active plan?
                    </p>
                )}
                <div className="flex items-center justify-center">
                    <Button
                        type="submit"
                        variant="text"
                        color="white"
                        onClick={() => statusChange(id)}
                        className="bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md text14"
                    >
                        Confirm
                    </Button>
                    <Button
                        variant="outlined"
                        color="white"
                        onClick={statusOpenModal}
                        className="ml-4 capitalize text-gray-900 border-gray-900 text14"
                    >
                        Cancel
                    </Button>
                </div>
            </Dialog>
        </div>
    );
};

export default PlanStatusChange;
