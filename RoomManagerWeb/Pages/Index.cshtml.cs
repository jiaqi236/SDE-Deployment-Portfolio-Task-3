using Microsoft.AspNetCore.Mvc.RazorPages;
using RoomManagerWeb.Models;

namespace RoomManagerWeb.Pages
{
    public class IndexModel : PageModel
    {
        public List<Room> Rooms { get; set; } = new();
        public List<Room> SearchResults { get; set; } = new();
        public string SearchTerm { get; set; } = string.Empty;
        public bool HasSearched { get; set; }

        public void OnGet(string? search)
        {
            // Initialize the room list with detailed descriptions
            Rooms = new List<Room>
            {
                new Room { RoomNumber = "R101", Description = "Meeting / Discussion Room (max 5 people)" },
                new Room { RoomNumber = "R102", Description = "Study Room (personal space — only 1 person)" },
                new Room { RoomNumber = "R201", Description = "Classroom (larger room for activities, classes, or tests)" },
                new Room { RoomNumber = "R202", Description = "Function Room (larger room for activities, events, or tests)" }
            };

            // Only run the search if a search term was entered
            if (!string.IsNullOrWhiteSpace(search))
            {
                HasSearched = true;
                SearchTerm = search.Trim();

                SearchResults = Rooms.Where(r =>
                    r.RoomNumber.Contains(SearchTerm, StringComparison.OrdinalIgnoreCase) ||
                    r.Description.Contains(SearchTerm, StringComparison.OrdinalIgnoreCase)
                ).ToList();
            }
        }
    }
}