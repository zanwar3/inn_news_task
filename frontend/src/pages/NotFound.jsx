import React from 'react';
import { Container, Typography } from '@mui/material';

export default function NotFound() {
  return (
    <Container className="flex justify-center items-center h-screen text-center bg-gray-100">
      <Typography variant="h1" className="text-gray-800">
        404 Page Not Found
      </Typography>
    </Container>
  );
}