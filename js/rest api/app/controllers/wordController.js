class wordController {
  constructor(log, WordService, httpStatus) {
    this.log = log;
    this.WordService = WordService;
    this.httpStatus = httpStatus;
  }

  async create(req, res) {
    try {
      const { words } = req.body;
      await this.WordService.createWords(words);
      res.status(201);
      res.send();
    } catch (err) {
      this.log.error(err.message);
      res.send(err);
    }
  }

  async deleteWord(req, res) {
    try {
      const { word } = req.params;
      const sanitizedWord = word.replace(/(.json)$/, '');
      await this.WordService.deleteWord(sanitizedWord);
      res.status(204);
      res.send();
    } catch (err) {
      this.log.error(err.message);
      res.send(err);
    }
  }

  async deleteAll(req, res) {
    try {
      await this.WordService.deleteAll();
      res.status(204);
      res.send();
    } catch (err) {
      this.log.error(err.message);
      res.send(err);
    }
  }

  async getStats(req, res) {
    try {
      const results = await this.WordService.getStats();
      res.send(results);
    } catch (err) {
      this.log.error(err.message);
      res.send(err);
    }
  }
}

module.exports = wordController;
