const joi = require('joi');

module.exports = joi.object().keys({
  // Validate words array
  words: joi.array().items(joi.string().min(1).max(100).required()),
}).required();
