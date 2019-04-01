class wordService {
  constructor(log, mongoose, errs) {
    this.log = log;
    this.mongoose = mongoose;
    this.errs = errs;
  }

  async createWords(words) {
    const Dictionary = this.mongoose.model('Dictionary');
    const wordsExist = await Dictionary.find({ word: { $in: words } }, { word: 1, _id: 0 });

    // Check for existing words, if already exist do not insert
    // Dictionary should be unique, if words already exist do not insert
    if (wordsExist.length !== 0) {
      const existingWords = [];
      for (const i in wordsExist) {
        existingWords.push(wordsExist[i].word);
      }

      // ES7 specific!
      words = words.filter(x => !existingWords.includes(x));
    }

    words = words.map(t => ({ word: t }));
    const wordsAdded = await Dictionary.insertMany(words);
    this.log.info('Words created successfully');
    return wordsAdded;
  }

  async deleteWord(word) {
    const Dictionary = this.mongoose.model('Dictionary');

    // Remove .json from the word
    const SanitizedWord = word.replace(/(.json)$/, '');

    const exists = await Dictionary.find({ word: SanitizedWord }, { word: 1, _id: 0 });

    if (exists.length === 0) {
      this.log.info(`Word '${SanitizedWord}' does not exit`);
      return;
    }

    const deleteWord = await Dictionary.deleteOne({ word: SanitizedWord });
    this.log.info(`Word '${SanitizedWord}' deleted successfully`);
    return deleteWord;
  }

  async deleteAll() {
    const Dictionary = this.mongoose.model('Dictionary');
    const DeleteAll = await Dictionary.deleteMany({});
    this.log.info('All words in the dictionary deleted successfully!');
    return DeleteAll;
  }

  async getStats() {
    const Dictionary = this.mongoose.model('Dictionary');
    const stats = await Dictionary.aggregate([
      {
        $project: {
          word: 1,
          length: { $strLenCP: '$word' },
        },
      },
      { $sort: { length: 1 } },
      {
        $group: {
          _id: '$_id.word',
          longestWord: { $last: '$word' },
          shortestWord: { $first: '$word' },
          totalRecords: { $sum: 1 },
          avgWordLength: { $avg: '$length' },
        },
      },
      {
        $project: {
          _id: 0,
          totalRecords: '$totalRecords',
          longestWord: '$longestWord',
          shortestWord: '$shortestWord',
          avgWordLengthRounded: { $ceil: '$avgWordLength' },
        },

      },
    ]);

    this.log.info(stats);
    return stats;
  }
}

module.exports = wordService;
