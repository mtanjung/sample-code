const joi = require('joi');

module.exports = joi.object().keys({
  // word must have .json extension
  word: joi.string().min(1).max(100).trim()
    .regex(/([a-zA-Z])+(.json)$/)
    .required(),
}).required();
