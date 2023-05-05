from bs4 import BeautifulSoup
import requests
import pandas as pd
from joblib import load
from collections import Counter
import sklearn
import json
import sys


def moduleML(url: str) -> list[str]:
    try:
        response = requests.get(url)
    except Exception:
        return 'Erreur url'

    # On parse le document HTML du site
    soup = BeautifulSoup(response.text, 'html.parser')

    # On récupère la div o-teaser__heading où se trouve les informations financières du site
    # ancien : 2 de trop div = soup.find_all("div", {"class": "o-teaser__heading"})
    div_time = soup.find_all('time',{"class": "o-date"})
    div_article = soup.find_all("div", {"class": "o-teaser--article"})
    div_title_article = [div.find("div", {"class": "o-teaser__heading"}) for div in div_article]

    liste_time = [div["datetime"] for div in div_time]

    # Titre pour le fichier data
    title = "News_Financieres;"

    # # On print les données
    # print(title)
    # for x in div:
    #     print(x.getText())

    # On créer le ficher data
    with open('data_WebScrapping.csv', 'w', encoding='utf-8') as csv_file:
        csv_file.write(title + '\n')
        for x in div_title_article:
            csv_file.write(x.getText() + ";" + '\n')

    # Lecture ficher data
    df = pd.read_csv("data_WebScrapping.csv", sep=';')

    # Suppression colonne inutile
    df = df.drop(columns="Unnamed: 1")

    # On charge le model
    model = load('python_module3/model.joblib')

    # On prédit
    predictions = model.predict(df.News_Financieres)

    d = {}
    for title, prediction, time in zip(df.News_Financieres, predictions, liste_time):
        time = time.split(".")[0].replace("T"," ")
        d[title] = prediction, time
    return json.dumps(d)

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
            