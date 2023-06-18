from bs4 import BeautifulSoup
import requests
import pandas as pd
from joblib import load
import sklearn
import json
import sys
from datetime import datetime


def moduleML(url: str) -> list[str]:
    try:
        response = requests.get(url)
    except Exception:
        return 'Erreur url'

    soup = BeautifulSoup(response.text, 'html.parser')

    div_time = soup.find_all('time',{"class": "o-date"})
    div_article = soup.find_all("div", {"class": "o-teaser--article"})
    div_title_article = [div.find("div", {"class": "o-teaser__heading"}) for div in div_article]
    titles_articles = [x.getText() for x in div_title_article]

    liste_time = [div["datetime"] for div in div_time]

    df = pd.DataFrame(titles_articles,columns=["News_Financieres"])
    model = load('python_module3/model.joblib')
    predictions = model.predict(df.News_Financieres)

    dict_predictions = {}
    for title, prediction, time in zip(df.News_Financieres, predictions, liste_time):
        str_time = time.split(".")[0].replace("T"," ")
        time = datetime. strptime(str_time[:19], '%Y-%m-%d %H:%M:%S')
        dict_predictions[title] = prediction, time.strftime("%d/%m/%Y %H:%M:%S")
    return json.dumps(dict_predictions)

def prediction_phrase(phrase:str) -> str:
    model = load('python_module3/model.joblib')
    prediction = model.predict([phrase])
    return prediction[0]


if __name__ == "__main__":

    if len(sys.argv)>1:
        print(sys.argv[1])
        print(prediction_phrase(sys.argv[1]))
    else:
        predictions_json = moduleML('https://www.ft.com/global-economy')
        with open("python_module3/predictions.json", "w") as outfile:
            outfile.write(predictions_json)
            