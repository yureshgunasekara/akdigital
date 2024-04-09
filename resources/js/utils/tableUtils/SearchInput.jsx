import React from "react";
import "@/Components/Table/tableStyle.css";

const SearchInput = ({ inputValue, setInputValue }) => {
    return (
        <div className="globalSearch">
            Global User Search
            <input
                value={inputValue || ""}
                onChange={(e) => setInputValue(e.target.value)}
            />
        </div>
    );
};

export default SearchInput;
