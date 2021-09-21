# Wordnet php wrapper

WordNet® is a large lexical database of English. Nouns, verbs, adjectives and adverbs are grouped into sets of cognitive
synonyms (synsets), each expressing a distinct concept.

As the result returned from wordent is in human-readable format, this library helps using the result in your php
projects by converting it to objects.

## Requirements

The library doesn't contain wordnet and its required to install it first.

## Examples

```
Wordnet::create()->search('cat');
```

