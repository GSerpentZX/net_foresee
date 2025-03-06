import sys
import pickle
import os

def identity(x):
    return x

def predict(text):
    # Load model
    script_dir = os.path.dirname(os.path.abspath(__file__))
    
    # Load TF-IDF Vectorizer
    with open(os.path.join(script_dir, 'tfidf_vectorizer.pkl'), 'rb') as f:
        vectorizer = pickle.load(f)
    
    # Load Naive Bayes model
    with open(os.path.join(script_dir, 'nb_classifier.pkl'), 'rb') as f:
        model = pickle.load(f)
        
    # Load Label Encoder
    with open(os.path.join(script_dir, 'label_encoder.pkl'), 'rb') as f:
        label_encoder = pickle.load(f)
    
    # Transform text
    x = vectorizer.transform([text])
    
    # Predict
    prediction = model.predict(x)
    
    # Decode label
    return label_encoder.inverse_transform(prediction)[0]

if __name__ == '__main__':
    text = sys.argv[1]
    print(predict(text))