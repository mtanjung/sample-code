

class anagramService {
  constructor(log, mongoose, errs) {
    this.log = log;
    this.mongoose = mongoose;
    this.errs = errs;
  }

  async getAnagrams(word, limit) {
    const Dictionary = this.mongoose.model('Dictionary');
    const wordLength = word.length;
    const useLimit = !!(limit);
    limit = parseInt(limit);

    const words = await Dictionary.find(
      { word: { $nin: [word] }, $where: `this.word.length == ${wordLength}` },
      { word: 1, _id: 0 },
    );

    if (words.length === 0) {
      this.log.info(`Anagram(s) not found for '${word}'`);
      return [];
    }

    // Loop words returned from db and find anagram
    const matches = [];
    let matchesCounter = 0;

    for (const i in words) {
      // console.log(words[i].word);
      const target = words[i].word;
      const isAnagram = this.isAnagram(word, target);

      if (isAnagram) {
        matches.push(target);
        matchesCounter++;

        if (useLimit && matchesCounter >= limit) {
          break;
        }
      }
    }

    this.log.info(`Anagram(s) found for '${word}' => '${matches}'`);
    return matches;
  }

  /*
   * Compare source and target string to see if they are anagrams
   */
  isAnagram(source, target) {
    if (source.length !== target.length) {
      return false;
    }

    const sourceCharCount = this.arrayCountValues(source);
    const targetCharCount = this.arrayCountValues(target);

    for (let i = 0; i < source.length; i++) {
      if (sourceCharCount[source[i]] !== targetCharCount[source[i]]) {
        return false;
      }
    }

    return true;
  }

  /*
   * Missed php function array_count_values :(
   * Count the number of occurrences of every character in a string.
   * e.g given 'words', return [ w: 1, o: 1, r: 1, s: 1, d: 1 ]
   */
  arrayCountValues(word) {
    const counts = [];

    for (let i = 0; i < word.length; i++) {
      const key = word[i];
      counts[key] = (counts[key]) ? counts[key] + 1 : 1;
    }

    return counts;
  }
}

module.exports = anagramService;
