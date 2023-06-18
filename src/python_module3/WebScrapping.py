from bs4 import BeautifulSoup
import requests
import pandas as pd
from joblib import load
import sklearn
import json
import sys


def moduleML(url: str) -> list[str]:
    try:
        response = requests.get(url)
    except Exception:
        return 'Erreur url'

    soup = BeautifulSoup(response.text, 'html.parser')

    div_time = soup.find_all('time',{"class": "o-date"})
    div_article = soup.find_all("div", {"class": "o-teaser--article"})
    div_title_article = [div.find("div", {"class": "o-teaser__heading"}) for div in div_article]

    liste_time = [div["datetime"] for div in div_time]

    title = "News_Financieres;"

    with open('data_WebScrapping.csv', 'w', encoding='utf-8') as csv_file:
        csv_file.write(title + '\n')
        for x in div_title_article:
            csv_file.write(x.getText() + ";" + '\n')

    df = pd.read_csv("data_WebScrapping.csv", sep=';')
    df = df.drop(columns="Unnamed: 1")
    model = load('model.joblib')
    predictions = model.predict(df.News_Financieres)

    d = {}
    for title, prediction, time in zip(df.News_Financieres, predictions, liste_time):
        time = time.split(".")[0].replace("T"," ")
        d[title] = prediction, time
    return json.dumps(d)

def prediction_phrase(phrase:str) -> str:
    model = load('model.joblib')
    prediction = model.predict([phrase])
    return prediction[0]


if __name__ == "__main__":
    if len(sys.argv)>1:
        print(sys.argv[1])
        print(prediction_phrase(sys.argv[1]))
    else:
        predictions_json = moduleML('https://www.ft.com/global-economy')
        with open("predictions.json", "w") as outfile:
            outfile.write(predictions_json)
            