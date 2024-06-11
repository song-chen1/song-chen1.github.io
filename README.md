# songchen.github.io
Song Chen's homepage

[![LICENSE](https://img.shields.io/github/license/yaoyao-liu/minimal-light?style=flat-square&logo=creative-commons&color=EF9421)](https://github.com/yaoyao-liu/yaoyao-liu.github.io/blob/main/LICENSE)

This is the latest version of my homepage's source code. Feel free to use and share.
<br />

The academic homepage consists of two parts:
- [Academic Homepage](https//:songchen.science) used for the academic resume.
-[Personal Blog](https//songchen.science/blog) used as a Technical Memorandum.

### Using Locally with Jekyll

You need to install [Ruby](https://www.ruby-lang.org/en/) and [Jekyll](https://jekyllrb.com/) fisrt.

Install and run:

```bash
bundle install
bundle exec jekyll server
```
View the live page using `localhost`:
<http://localhost:4000>. You can get the html files in the `_site` folder.

### Google Scholar Crawler
#### Summary
Details of publications should still be added manually including:
- `title`: title of the article
- `author`: authors of the article
- `confernce_short`: abbreviation of the journal
- `conference`: full name of the journal
- `pdf`: address of the pdf file of the article
- `page`
- `bibtex`: used for the reference in the latex
- `image`: preview of the journal cover
- `citation`: generated automatically based on the journal url in Googlescholar
- `notes` add remarks for the journal

The citations can be extracted from the JSON. file generated from the Github workflow. The python script used for the generation of JSON. file is shown as follows:
```python
from scholarly import scholarly
import jsonpickle
import json
from datetime import datetime
import os

author: dict = scholarly.search_author_id('sf-0AGoAAAAJ&hl')
scholarly.fill(author, sections=['basics', 'indices', 'counts', 'publications'])
name = author['name']
author['updated'] = str(datetime.now())
author['publications'] = {v['author_pub_id']:v for v in author['publications']}
print(json.dumps(author, indent=2))
os.makedirs('results', exist_ok=True)
with open(f'results/gs_data.json', 'w') as outfile:
    json.dump(author, outfile, ensure_ascii=False)

shieldio_data = {
  "schemaVersion": 1,
  "label": "citations",
  "message": f"{author['citedby']}",
}
with open(f'results/gs_data_shieldsio.json', 'w') as outfile:
    json.dump(shieldio_data, outfile, ensure_ascii=False)
```
2. Configure the google scholar citation crawler:
    1.  Find your google scholar ID in the url of your google scholar page (e.g., [https://scholar.google.com/citations?user=SCHOLAR\_ID](https://scholar.google.com/citations?user=SCHOLAR_ID)), where `SCHOLAR_ID` is your google scholar ID.
    2.  Set GOOGLE\_SCHOLAR\_ID variable to your google scholar ID in `Settings -> Secrets -> Actions -> New repository secret` of the REPO website with `name=GOOGLE_SCHOLAR_ID` and `value=SCHOLAR_ID`.
    3.  Click the `Action` of the REPO website and enable the workflows by clicking _"I understand my workflows, go ahead and enable them"_. This github action will generate google scholar citation stats data `gs_data.json` in `google-scholar-stats` branch of your REPO. When you update your main branch, this action will be triggered. This action will also be trigger 08:00 UTC everyday.

The instructions for the Google Scholar crawler can be found in [this repository](https://github.com/RayeRen/acad-homepage.github.io).
<br>

3. Navigate to the _data/publications.yml file:
Add the corresponding journal information

4. Based on the url given for the `citation`, the citation number can be shown.

To-DO list:
- Automating the gernation of the `publication.yml` file based on the Googlescholar profile.

### Acknowledgements

This project uses the source code from the following repositories:

* [pages-themes/minimal](https://github.com/pages-themes/minimal)

* [orderedlist/minimal](https://github.com/orderedlist/minimal)

* [al-folio](https://github.com/alshedivat/al-folio)

* [AcadHomepage](https://github.com/RayeRen/acad-homepage.github.io)

* [yaoyao-liu homepage](https://github.com/yaoyao-liu/yaoyao-liu.github.io)
