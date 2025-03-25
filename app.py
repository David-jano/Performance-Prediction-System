from flask import Flask, request, jsonify
from flask_cors import CORS
import pickle
import numpy as np

app = Flask(__name__)
CORS(app)

# Load the trained model last_model.pkl
model = None
try:
    with open("last_model.pkl", "rb") as f:
        model = pickle.load(f)
    print("Model loaded successfully!")
except Exception as e:
    print(f"Error loading model: {e}")

@app.route('/predict', methods=['POST'])
def predict():
    try:
        # Get data from the request
        data = request.json
        print(f"Received data: {data}")  # Log received data

        # Ensure all required fields are provided
        required_fields = [
            'Gender', 'Age', 'Year_of_Study', 'Attendance', 'Health_Condition', 
            'Family_Background_Low', 'Family_Background_Middle', 
            'Department_Computer_Science', 'Department_Electrical_Engineering'
        ]
        
        if not all(field in data for field in required_fields):
            return jsonify({"error": "Missing required fields"}), 400

        # Prepare the features array for prediction
        features = np.array([[
            data['Gender'], 
            data['Age'], 
            data['Year_of_Study'], 
            data['Attendance'], 
            data['Health_Condition'], 
            data['Family_Background_Low'], 
            data['Family_Background_Middle'], 
            data['Department_Computer_Science'], 
            data['Department_Electrical_Engineering']
        ]])
        

        print(f"Features for model: {features}")  # Log features being passed to model

        # Make prediction using the model
        if model is None:
            return jsonify({"error": "Model is not loaded"}), 500

        prediction = model.predict(features)

        # Log the prediction to check if the model is giving the correct output
        print(f"Prediction: {prediction}")

        # Return the prediction result as a JSON response
        return jsonify({"prediction": prediction.tolist()}), 200

    except Exception as e:
        print(f"Error during prediction: {e}")
        return jsonify({"error": str(e)}), 500


if __name__ == "__main__":
    app.run(debug=True, port=5008)
