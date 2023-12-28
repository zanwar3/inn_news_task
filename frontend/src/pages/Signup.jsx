import { Link as RouterLink } from "react-router-dom";
import { useRef, useState } from "react";
import { useStateContext } from "../context/ContextProvider.jsx";
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

export default function Signup() {
  const nameRef = useRef();
  const emailRef = useRef();
  const passwordRef = useRef();
  const passwordConfirmationRef = useRef();
  const { setUser, setToken } = useStateContext();
  const [errors, setErrors] = useState(null);
  const { callApi, loading, error } = useAxios();

  const onSubmit = async (ev) => {
    ev.preventDefault();
    const data = await callApi("/register", "post", {
      name: nameRef.current?.value,
      email: emailRef.current?.value,
      password: passwordRef.current?.value,
      c_password: passwordConfirmationRef.current?.value,
    });
    if (data) {
      setUser(data.user);
      setToken(data.token);
    }

    if (error && error.response && error.response.status === 422) {
      setErrors(error.response.data.errors);
    }
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
          Signup for Free
        </Typography>
        <Box component="form" onSubmit={onSubmit} noValidate sx={{ mt: 1 }}>
          {errors &&
            Object.keys(errors).map((key) => (
              <Alert severity="error" key={key}>
                {errors[key][0]}
              </Alert>
            ))}
          <TextField
            margin="normal"
            required
            fullWidth
            id="name"
            label="Full Name"
            name="name"
            autoComplete="name"
            autoFocus
            inputRef={nameRef}
          />
          <TextField
            margin="normal"
            required
            fullWidth
            id="email"
            label="Email Address"
            name="email"
            autoComplete="email"
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
            autoComplete="new-password"
            inputRef={passwordRef}
          />
          <TextField
            margin="normal"
            required
            fullWidth
            name="passwordConfirmation"
            label="Repeat Password"
            type="password"
            id="passwordConfirmation"
            autoComplete="new-password"
            inputRef={passwordConfirmationRef}
          />
          <Button
            type="submit"
            fullWidth
            variant="contained"
            sx={{ mt: 3, mb: 2 }}
          >
            Signup
          </Button>
          <Grid container>
            <Grid item>
              <RouterLink to="/login">
                {"Already registered? Sign In"}
              </RouterLink>
            </Grid>
          </Grid>
        </Box>
      </Box>
    </Container>
  );
}
