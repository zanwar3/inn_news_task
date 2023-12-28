// Filter.jsx
import React, { useState, useEffect } from "react";
import {
  MenuItem,
  Select,
  FormControl,
  InputLabel,
  Button,
  ButtonGroup,
} from "@mui/material";
import { useStateContext } from "../context/ContextProvider";
import useAxios from "../hooks/useAxios";
import SearchIcon from "@mui/icons-material/Search";
import SaveIcon from "@mui/icons-material/Save";
import ClearIcon from "@mui/icons-material/Clear";
import ArrowBackIosIcon from "@mui/icons-material/ArrowBackIos";
import ArrowForwardIosIcon from "@mui/icons-material/ArrowForwardIos";

import { useNavigate } from "react-router-dom";
export default function Filter() {
  const navigate = useNavigate();
  const { token, setParms, setNotification, defaultParms } = useStateContext();
  const { callApi, loading, error, data } = useAxios();
  const [date, setDate] = useState("");
  const [keyword, setKeyword] = useState("");
  const [categories, setCategories] = useState([]);
  const [sources, setSources] = useState([]);
  const [page, SetPage] = useState(1);
  const [size, SetSize] = useState(50);

  useEffect(() => {
    if (data) {
      setNotification(data?.data?.message);
    }
    if (error) {
      setNotification(error.response.data.message);
    }
  }, [data, error]);

  const onSavePreference = async () => {
    if (token) {
      // Call API to save preference
      await callApi("/preferences", "post", {
        preferences: { categories, sources },
      });
    } else {
      // Redirect to login page
      navigate("/login");
    }
  };

  const search = () => {
    let fromDate;
    let toDate = new Date();

    switch (date) {
      case 10: // Today
        fromDate = new Date();
        break;
      case 20: // This Week
        fromDate = new Date();
        fromDate.setDate(toDate.getDate() - 7);
        break;
      case 30: // This Month
        fromDate = new Date();
        fromDate.setMonth(toDate.getMonth() - 1);
        break;
      default:
        fromDate = null;
        toDate = null;
    }
    if (fromDate && toDate) {
      fromDate = `${fromDate.getFullYear()}-${
        fromDate.getMonth() + 1
      }-${fromDate.getDate()}`;
      toDate = `${toDate.getFullYear()}-${
        toDate.getMonth() + 1
      }-${toDate.getDate()}`;
    }
    setParms({ keyword, fromDate, toDate, categories, sources, page, size });
  };
  const clearFilter = () => {
    setDate("");
    setKeyword("");
    setCategories([]);
    setSources([]);
  };

  const nextPage = () => {
    SetPage(page + 1);
    search();
  };

  const prevPage = () => {
    if (page > 0) {
      SetPage(page - 1);
      search();
    }
  };
  return (
    <div className="flex flex-wrap justify-start gap-4">
      {" "}
      {/* Added gap-4 for spacing */}
      <div className="relative rounded-md shadow-sm w-full sm:w-auto">
        <input
          className="block h-full w-full pl-10 sm:text-sm rounded-md"
          placeholder="Search…"
          aria-label="search"
          value={keyword}
          onChange={(event) => setKeyword(event.target.value)}
        />
      </div>
      <FormControl className="w-full grow sm:w-auto">
        <InputLabel id="filter-by-date">Filter by Date</InputLabel>
        <Select
          labelId="filter-by-date"
          id="filter-by-date"
          value={date}
          label="Filter by Date"
          onChange={(event) => setDate(event.target.value)}
        >
          <MenuItem value={10}>Today</MenuItem>
          <MenuItem value={20}>This Week</MenuItem>
          <MenuItem value={30}>This Month</MenuItem>
        </Select>
      </FormControl>
      <FormControl className="w-auto grow sm:w-auto">
        <InputLabel id="filter-by-category">Filter by Category</InputLabel>
        <Select
          labelId="filter-by-category"
          id="filter-by-category"
          value={categories ?? ""}
          label="Filter by Category"
          multiple
          onChange={(event) => setCategories(event.target.value)}
        >
          {defaultParms?.categories
            ? defaultParms?.categories.map((item, index) => (
                <MenuItem key={`cat_${index}`} value={item}>
                  {item}
                </MenuItem>
              ))
            : null}
        </Select>
      </FormControl>
      <FormControl className="w-full grow sm:w-auto">
        <InputLabel id="filter-by-source">Filter by Source</InputLabel>
        <Select
          labelId="filter-by-source"
          id="filter-by-source"
          value={sources ?? ""}
          label="Filter by Source"
          multiple
          onChange={(event) => setSources(event.target.value)}
        >
          {defaultParms?.sources
            ? defaultParms?.sources.map((item, index) => (
                <MenuItem key={`src_${index}`} value={item}>
                  {item}
                </MenuItem>
              ))
            : null}
        </Select>
      </FormControl>
      <ButtonGroup
        variant="outlined"
        aria-label="button group"
        className="w-full sm:w-auto"
      >
        <Button onClick={search}>
          <SearchIcon />
        </Button>
        <Button color="success" onClick={onSavePreference}>
          <SaveIcon />
        </Button>
        <Button color="warning" onClick={clearFilter}>
          <ClearIcon />
        </Button>
      </ButtonGroup>
      <ButtonGroup
        variant="outlined"
        aria-label="page navigation"
        className="w-full sm:w-auto"
      >
        <Button disabled={page === 1} onClick={prevPage}>
          <ArrowBackIosIcon />
        </Button>
        <Button>{page}</Button>
        <Button disabled={data && data.length === 0} onClick={nextPage}>
          <ArrowForwardIosIcon />
        </Button>
      </ButtonGroup>
    </div>
  );
}
