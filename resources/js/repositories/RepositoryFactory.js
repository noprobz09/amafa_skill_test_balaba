import PersonFactory from "./factories/PersonFactory";


const repositories = {
    persons: PersonFactory,
};

export const RepositoryFactory = {
  get: name => repositories[name]
};