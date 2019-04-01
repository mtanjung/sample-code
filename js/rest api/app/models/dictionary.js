// const config = require('../configs/configs');
const serviceLocator = require('../lib/serviceLocator');
const mongoose = serviceLocator.get('mongoose');
const dictionarySchema = mongoose.Schema({
  word: {
    type: String,
    required: true,
    index: true,
    unique: true,
    lowercase: true,
    trim: true,
  },
});

module.exports = mongoose.model('Dictionary', dictionarySchema);
