const serviceLocator = require('../lib/serviceLocator');
const config = require('./configs')();

serviceLocator.register('logger', () => require('../lib/logger').create(config.application_logging));

serviceLocator.register('httpStatus', () => require('http-status'));

serviceLocator.register('mongoose', () => require('mongoose'));

serviceLocator.register('errs', () => require('restify-errors'));

serviceLocator.register('WordService', (serviceLocator) => {
  const log = serviceLocator.get('logger');
  const mongoose = serviceLocator.get('mongoose');
  const errs = serviceLocator.get('errs');
  const WordService = require('../services/wordService');

  return new WordService(log, mongoose, errs);
});

serviceLocator.register('AnagramService', (serviceLocator) => {
  const log = serviceLocator.get('logger');
  const mongoose = serviceLocator.get('mongoose');
  const errs = serviceLocator.get('errs');
  const AnagramService = require('../services/AnagramService');

  return new AnagramService(log, mongoose, errs);
});

serviceLocator.register('wordController', (serviceLocator) => {
  const log = serviceLocator.get('logger');
  const httpStatus = serviceLocator.get('httpStatus');
  const WordService = serviceLocator.get('WordService');
  const wordController = require('../controllers/wordController');

  return new wordController(log, WordService, httpStatus);
});

serviceLocator.register('anagramController', (serviceLocator) => {
  const log = serviceLocator.get('logger');
  const httpStatus = serviceLocator.get('httpStatus');
  const AnagramService = serviceLocator.get('AnagramService');
  const anagramController = require('../controllers/anagramController');

  return new anagramController(log, AnagramService, httpStatus);
});

module.exports = serviceLocator;
