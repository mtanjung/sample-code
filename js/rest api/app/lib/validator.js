const httpStatus = require('http-status');
const errors = require('restify-errors');

module.exports.paramValidation = function (log, joi) {
  return function (req, res, next) {
    // always allow validation to allow unknown fields by default.
    const options = {
      allowUnknown: true,
    };

    const { validation } = req.route.spec; // validation object in route
    if (!validation) {
      return next(); // skip validation if not set
    }

    const validProperties = ['body', 'query', 'params'];

    for (const i in validation) {
      if (validProperties.indexOf(i) < 0) {
        log.debug('Route contains unsupported validation key');
        throw new Error('An unsupported validation key was set in route');
      } else {
        if (req[i] === undefined) {
          log.debug(`Empty request ${i} was sent`);

          res.send(
            httpStatus.BAD_REQUEST,
            new errors.InvalidArgumentError(`Missing request ${i}`),
          );
          return;
        }

        const result = joi.validate(req[i], validation[i], options);

        if (result.error) {
          log.debug('validation error - %s', result.error.message);

          res.send(
            httpStatus.BAD_REQUEST,
            new errors.InvalidArgumentError(
              `Invalid request ${i} - ${result.error.details[0].message}`,
            ),
          );
          return;
        }
        log.info('successfully validated request parameters');
      }
    }

    next();
  };
};
