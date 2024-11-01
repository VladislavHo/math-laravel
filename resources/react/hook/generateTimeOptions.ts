const generateTimeOptions = () => {
  const options = [];
  for (let hour = 9; hour <= 16; hour++) {
    for (const minute of [0, 30]) {
      const time = `${hour}:${minute < 10 ? '0' : ''}${minute}`;
      options.push(time);
    }
  }
  return options;
};

export default generateTimeOptions