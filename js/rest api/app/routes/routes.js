module.exports.register = (server, serviceLocator) => {
  /*
   * Words endpoint
   */
  server.post(
    {
      path: '/words.json',
      name: 'Create words',
      // version: '1.0.0',
      validation: {
        body: require('../validators/createWordsValidator'),
      },
    },
    (req, res, next) => serviceLocator.get('wordController').create(req, res, next),
  );

  server.del(
    {
      path: '/words/:word',
      name: 'Delete one word',
      // version: '1.0.0',
      validation: {
        params: require('../validators/deleteWordValidator'),
      },
    },
    (req, res, next) => serviceLocator.get('wordController').deleteWord(req, res, next),
  );

  server.del(
    {
      path: '/words.json',
      name: 'Delete All Words',
      // version: '1.0.0',
    },
    (req, res, next) => serviceLocator.get('wordController').deleteAll(req, res, next),
  );

  server.get(
    {
      path: '/words/stats.json',
      name: 'Get statistic of words in the dictionary',
      // version: '1.0.0',
    },
    (req, res, next) => serviceLocator.get('wordController').getStats(req, res, next),
  );

  /*
   * Anagrams endpoint
   */
  server.get(
    {
      path: '/anagrams/:word',
      name: 'Get anagrams for passed word',
      // version: '1.0.0',
      validation: {
        params: require('../validators/deleteWordValidator'),
        query: require('../validators/limitValidator'),
      },
    },
    (req, res, next) => serviceLocator.get('anagramController').getAnagrams(req, res, next),
  );
};
