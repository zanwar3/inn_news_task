import { useEffect, useState } from "react";
import NewsGrid from "../components/NewsGrid";
import { useStateContext } from "../context/ContextProvider";
import useAxios from "../hooks/useAxios";
import CircularProgress from "@mui/material/CircularProgress";

export default function MyNews() {
  const [news, setNews] = useState([]);
  const { setNotification } = useStateContext();
  const { callApi, loading, error, data } = useAxios();
  useEffect(() => {
    callApi("/feed", "get");
  }, [callApi]);

  useEffect(() => {
    if (data) {
      setNews(data.data);
    }
    if (error) {
      setNotification(error.toString());
    }
  }, [data, error, setNotification]);
  return (
    <div className="mt-20">
      {loading ? <CircularProgress /> : <NewsGrid news={news} />}
    </div>
  );
}
