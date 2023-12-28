# Use the specific Node.js version
FROM node:18.14.0

# Set the working directory in the Docker image
WORKDIR /app

# Copy package.json and package-lock.json to the working directory
COPY package*.json ./

# Install dependencies in the Docker image
RUN npm install

# Copy the rest of your app's source code to the working directory
COPY . .

# Build the app
RUN npm run build

# Expose the port your app runs on
EXPOSE 5173

# Start the app
CMD [ "npm", "run" ,"dev" ]