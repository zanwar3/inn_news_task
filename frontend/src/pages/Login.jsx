import { Link as RouterLink } from "react-router-dom";
import { useRef,useEffect } from "react";
import { useStateContext } from "../context/ContextProvider.jsx";
import { useState } from "react";
import useAxios from "../hooks/useAxios";
import {
  Button,
  TextField,
  Grid,
  Typography,
  Container,
  Alert,
} from "@mui/material";
import { Box } from "@mui/system";

export default function Login() {
  const emailRef = useRef();
  const passwordRef = useRef();
  const { setUser, setToken } = useStateContext();
  const [message, setMessage] = useState(null);
  const { callApi, loading, error, data } = useAxios();

  useEffect(() => {
    if (data) {
      console.log(data);
      setUser(data?.data?.name);
      setToken(data?.data?.token);
    }

    if (error && error.response) {
      setMessage(error.response.data.message);
    }
  }, [data, error]);


  const onSubmit = async (ev) => {
    ev.preventDefault();

    await callApi("/login", "post", {
      email: emailRef.current?.value,
      password: passwordRef.current?.value,
    });
  };

  return (
    <Container component="main" maxWidth="xs">
      <Box
        sx={{
          marginTop: 8,
          display: "flex",
          flexDirection: "column",
          alignItems: "center",
        }}
      >
        <Typography component="h1" variant="h5">
          Login To Your Account
        </Typography>
        <Box component="form" onSubmit={onSubmit} noValidate sx={{ mt: 1 }}>
          {message && <Alert severity="error">{message}</Alert>}
          <TextField
            margin="normal"
            required
            fullWidth
            id="email"
            label="Email Address"
            name="email"
            autoComplete="email"
            autoFocus
            inputRef={emailRef}
          />
          <TextField
            margin="normal"
            required
            fullWidth
            name="password"
            label="Password"
            type="password"
            id="password"
            autoComplete="current-password"
            inputRef={passwordRef}
          />
          <Button
            type="submit"
            fullWidth
            variant="contained"
            sx={{ mt: 3, mb: 2 }}
            disabled={loading}
          >
            Confirm identity
          </Button>
          <Grid container>
            <Grid item>
              <RouterLink to="/signup">
                {"Not registered? Create an account"}
              </RouterLink>
            </Grid>
          </Grid>
        </Box>
      </Box>
    </Container>
  );
}
