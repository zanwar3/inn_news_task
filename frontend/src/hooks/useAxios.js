import { useState, useCallback } from 'react';
import axiosClient from '../utils/axiosClient';

function useAxios() {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const callApi = useCallback(async (url, method = 'get', body = null, params = {}) => {
    setLoading(true);
    setError(null);
    try {
      const response = await axiosClient[method](url, {...body, params });
      setData(response.data);
    } catch (err) {
      setError(err);
    } finally {
      setLoading(false);
    }
  }, []);

  return { data, loading, error, callApi };
}

export default useAxios;