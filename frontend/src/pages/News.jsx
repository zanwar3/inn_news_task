import { useEffect, useState } from "react";
import NewsGrid from "../components/NewsGrid";
import { useStateContext } from "../context/ContextProvider";
import Filter from "../components/Filter";
import useAxios from "../hooks/useAxios";
import CircularProgress from "@mui/material/CircularProgress";

export default function News() {
  const [news, setNews] = useState([]);
  const { parms, setNotification } = useStateContext();
  const { callApi, data, loading, error } = useAxios();
  useEffect(() => {
    console.log(parms)
    callApi("/search", "get", null, parms);
  }, [parms, callApi]);

  useEffect(() => {
    if (data) {
      setNews(data.data);
    }
    if (error) {
      setNotification(error.toString());
    }
  }, [data, error, setNotification]);
  return (
    <div className="w-full">
      <Filter />
      {loading ? <CircularProgress /> : <NewsGrid news={news} />}
    </div>
  );
}
