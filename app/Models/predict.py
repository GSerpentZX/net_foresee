import sys
import joblib
import os

# Path model
base_path = os.path.dirname(os.path.abspath(__file__))
model_path = os.path.join(base_path, "naive_bayes_model.pkl")
vectorizer_path = os.path.join(base_path, "tfidf_vectorizer.pkl")

# Debugging: Print path
print(f"Loading model from: {model_path}")
print(f"Loading vectorizer from: {vectorizer_path}")

try:
    model = joblib.load(model_path)
    vectorizer = joblib.load(vectorizer_path)
except Exception as e:
    print(f"Error loading model: {str(e)}")
    sys.exit(1)

# Ambil input
input_text = sys.argv[1] if len(sys.argv) > 1 else ""

if not input_text:
    print("Error: No input text provided")
    sys.exit(1)

# Preprocessing
input_text = input_text.lower().strip()
input_tfidf = vectorizer.transform([input_text])

# Prediksi
prediction = model.predict(input_tfidf)[0]
result = "POSITIVE" if prediction == 1 else "NEGATIVE"

print(result)
