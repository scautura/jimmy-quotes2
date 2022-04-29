import aiohttp
import contextlib
import logging

from redbot.core import commands
from redbot.core.utils.chat_formatting import bold

log = logging.getLogger("red.scautura`.quotes")


class Quotes(commands.Cog):
    """Get a random quote."""

    __version__ = "0.1.0"
    __author__ = ["Scautura"]

    def __init__(self, bot):
        self.bot = bot
        self.api = 'https://jimmy.scautura.co.uk/api/quotes'
        self.random = '/random'
        self.session = aiohttp.ClientSession()

    def cog_unload(self):
        self.bot.loop.create_task(self.session.close())
        log.debug("Session closed.")
        with contextlib.suppress(Exception):
            self.bot.remove_dev_env_value("quotes")

    def format_help_for_context(self, ctx: commands.Context) -> str:
        context = super().format_help_for_context(ctx)
        authors = ", ".join(self.__author__)
        return f"{context}\n\nAuthor: {authors}\nVersion: {self.__version__}"

    async def initialize(self) -> None:
        if 141168475711340544 in self.bot.owner_ids:
            with contextlib.suppress(Exception):
                self.bot.add_dev_env_value("quotes", lambda x: self)

    async def red_delete_data_for_user(self, **kwargs):
        """Nothing to delete."""
        return

    @commands.command()
    async def quote(self, ctx, *, quote: str = "None"):
        """Get a random quote."""
        await ctx.trigger_typing()
        if quote.isnumeric() == False:
            async with self.session.get(self.api + self.random) as r:
                content = await r.json()
        else:
            async with self.session.get(self.api + "/" + str(quote)) as r:
                content = await r.json()
        formatter = lambda x, y: f"From {bold(x)}\n> {y}"
        return await ctx.send(formatter(content["author_name"], content["text"]))

