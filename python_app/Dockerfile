# Use the official Python image
FROM python:3.9

# Set the working directory inside the container
WORKDIR /app

# Copy all files from the current directory to the container
COPY . /app

# Install necessary Python dependencies
RUN pip install --no-cache-dir flask flask-cors chromadb google-generativeai load_dotenv

# Expose the port Flask runs on
EXPOSE 5000

# Run the Python script when the container starts
CMD ["python", "main.py"]
