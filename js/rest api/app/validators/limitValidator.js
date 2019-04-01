const joi = require('joi');

module.exports = {
  limit: joi.number().integer().min(1).max(1000),
};
