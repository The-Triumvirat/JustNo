# JustNo  

A tiny service that exists for one simple purpose:

> Give you a well-phrased, occasionally sassy  
> **NO.**

No productivity hacks.  
No complex dashboards.  
No “AI-powered enterprise synergy cloud platform”.  
Just… **No.**

---

## What is this?

JustNo is a small Laravel application that serves random “No Reasons” via:

- a simple public webpage  
- a dedicated *specific No* page  
- a JSON API  

You click → you get a reason why the answer is no.  
Sometimes there’s even an easter egg pretending to say yes…  
…but don’t trust it.

---

## Features

✔️ Random “No Reason” generator  
✔️ Shareable specific pages (`/no/{id}`)  
✔️ Copy & Share buttons  
✔️ API for integration fun  
✔️ Rate limiting  
✔️ Funny HTTP 429 message  
✔️ Admin backend to manage reasons  
✔️ Import / Export (JSON)  
✔️ Built with love, sarcasm, and a calm turquoise theme  

No analytics.  
No tracking.  
No growth hacking.  
Just… No.

---

## API

### Random No
```
GET /api/v1/no
```

Response
```json
{
  "id": 12,
  "reason": "No. Absolutely not."
}
```

---

### Specific No
```
GET /api/v1/no/{id}
```

Response
```json
{
  "id": 12,
  "reason": "No. Absolutely not."
}
```

If it doesn’t exist → proper 404.

---

## Frontend

The home page loads a random No.  
Each shared No has its own link:

```
/no/{id}
```

Looks pretty.  
Does one thing well.  
The end.

---

## Inspiration

This project is inspired by and based on the idea from  
https://github.com/hotheadhacker/no-as-a-service/tree/main  
and was rebuilt, extended, and slightly overengineered — just for fun

---
## Why does this exist?

Because:
- saying no is important  
- sometimes “no” needs flavor  
- not everything has to be “a startup”  
- and building fun things is allowed  

Also: it’s funny.

---

## Tech Stack

- Laravel  
- Blade frontend  
- MariaDB / PostgreSQL compatible  
- A responsible amount of JavaScript  
- Zero frontend frameworks (on purpose)

---

## License

AGPL.  
If you run it and improve it, give back.  
Don’t be weird about it.

---

## Credits

Built because sometimes you need a friendly wall that simply says:

> “No.”

And does it beautifully.
