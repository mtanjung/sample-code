class anagramController {
  constructor(log, AnagramService, httpStatus) {
    this.log = log;
    this.AnagramService = AnagramService;
    this.httpStatus = httpStatus;
  }

  async getAnagrams(req, res) {
    try {
      const { limit } = req.query;
      const { word } = req.params;
      // Remove .json from the word
      const sanitizedWord = word.replace(/(.json)$/, '');
      const result = await this.AnagramService.getAnagrams(sanitizedWord, limit);
      res.send(result);
    } catch (err) {
      this.log.error(err.message);
      res.send(err);
    }
  }
}

module.exports = anagramController;
