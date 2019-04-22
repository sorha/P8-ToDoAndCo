# Contribution Guide

Comment contribuer au projet :

1. Réaliser un fork du répertoire Github du projet
2. Cloner localement de votre fork
```
git clone https://github.com/VotrePseudo/P8-ToDoAndCo.git
```
3. Installer le projet et ses dépendances [voir instructions](../README.md)
4. Créer une branche
```
git checkout -b nouvelle-branch
```
5. Push la branch sur votre fork
```
git push origin nouvelle-branch
```
6. Ouvrir une pull request sur le répertoire Github du projet

# Processus de qualité

Lancer les tests avec génération d'un rapport de code coverage :
```
php bin/phpunit --coverage-html docs/code-coverage
```
Pour implémenter de nouveaux tests, se référer à la [documentation officielle de Symfony](https://symfony.com/doc/4.2/testing.html)
Si votre test nécessite une base de données de test, vous pouvez faire hériter votre classe par `DataFixturesTestCase` qui chargera automatiquement des fixtures de test `TestFixtures` dans la base de données qui a été défini dans le fichier `.env.test`